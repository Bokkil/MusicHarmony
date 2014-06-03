/*
Copyright (C) 2013 Antoine Lafarge qtwebsocket@gmail.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

#include "SocketThread.h"
#include <string>
#include <QtCore>
#include <QString>
#include <iostream>
#include <tr1/cstdint>
#include "JsonParser.h"
#include "/usr/include/mysql/mysql.h"

MYSQL *conn;
MYSQL_RES *res;
MYSQL_ROW row;

char *server = "localhost";
char *user = "mh";
char *password = "thak2014";
char *database = "mh";

/**
 * @brief SocketThread::SocketThread
 * @param wsSocket
 */
SocketThread::SocketThread(QtWebsocket::QWsSocket* wsSocket) :
	socket(wsSocket)
{
	// Set this thread as parent of the socket
	// This will push the socket in the good thread when using moveToThread on the parent
	if (socket)
	{
		socket->setParent(this);
	}

	// Move this thread object in the thread himsleft
	// Thats necessary to exec the event loop in this thread
	moveToThread(this);
}

/**
 * @brief SocketThread::~SocketThread
 */
SocketThread::~SocketThread()
{
}

/**
 * @brief SocketThread::run
 */
void SocketThread::run()
{
    std::cout << tr("connect done in thread : 0x%1").arg(QString::number((intptr_t)QThread::currentThreadId(), 16)).toStdString() << std::endl;

    if( !(conn = mysql_init((MYSQL*)NULL))){
      printf("init fail\n");
      exit(1);
    }

    printf("mysql_init success.\n");

    if(!mysql_real_connect(conn, server, user, password, NULL, 3306, NULL, 0)){
      printf("connect error.\n");
      exit(1);
    }

    printf("mysql_real_connect success.\n");

    if(mysql_select_db(conn, database) != 0){
      mysql_close(conn);
      printf("select_db fail.\n");
      exit(1);
    }

	// Connecting the socket signals here to exec the slots in the new thread
	QObject::connect(socket, SIGNAL(frameReceived(QString)), this, SLOT(processMessage(QString)));
	QObject::connect(socket, SIGNAL(disconnected()), this, SLOT(socketDisconnected()));
	QObject::connect(socket, SIGNAL(pong(quint64)), this, SLOT(processPong(quint64)));
	QObject::connect(this, SIGNAL(finished()), this, SLOT(finished()), Qt::DirectConnection);

	// Launch the event loop to exec the slots
	exec();
}

/**
 * @brief SocketThread::finished
 */
void SocketThread::finished()
{
        mysql_close(conn);
	this->moveToThread(QCoreApplication::instance()->thread());
	this->deleteLater();
}

/**
 * @brief SocketThread::processMessage
 * @param message
 */
void SocketThread::processMessage(QString message)
{
	// ANY PROCESS HERE IS DONE IN THE SOCKET THREAD !
    JsonParser jsonparser;
    QString json = jsonparser.read(message);
    QString retMessage;
    char retBuffer[255];
    char *retName;

    std::cout << tr("thread 0x%1 | %2")
                 .arg(QString::number((intptr_t)QThread::currentThreadId(), 16)).arg(message).toStdString() << std::endl;

    QString select = "select SOUND_PATH from sounds where id = ";
    QString query = select + message;
    const char *rawQuery = query.toStdString().c_str();
    if(mysql_query(conn,rawQuery )){
      printf("query fail\n");
      exit(1);
    }

    printf("query success\n");

    res = mysql_store_result(conn);

    while( (row=mysql_fetch_row(res))!=NULL){
      retName = strcpy(retBuffer, row[0]);
    }
    printf("%s\n", retName);
    mysql_close(conn);

    sendMessage(retName);
}

/**
 * @brief SocketThread::sendMessage
 * @param message
 */
void SocketThread::sendMessage(QString message)
{
	socket->write(message);
}

/**
 * @brief SocketThread::processPong
 * @param elapsedTime
 */
void SocketThread::processPong(quint64 elapsedTime)
{
	std::cout << tr("ping: %1 ms").arg(elapsedTime).toStdString() << std::endl;
}

/**
 * @brief SocketThread::socketDisconnected
 */
void SocketThread::socketDisconnected()
{
	std::cout << tr("Client disconnected, thread finished").toStdString() << std::endl;
	
	// Prepare the socket to be deleted after last events processed
	socket->deleteLater();

	// finish the thread execution (that quit the event loop launched by exec)
	//quit();
}
