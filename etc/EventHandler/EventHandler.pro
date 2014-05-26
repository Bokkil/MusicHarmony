QT       += core network

QT       -= gui

TARGET = EventHandler
CONFIG   += console
CONFIG   -= app_bundle

TEMPLATE = app

INCLUDEPATH += ../QtWebsocket/ \
    /usr/include/mysql

SOURCES += main.cpp \
    MainLogic.cpp \
    SocketThread.cpp \
    ServerThreaded.cpp \
    UdpServer.cpp \
    JsonParser.cpp

HEADERS += \
    MainLogic.h \
    SocketThread.h \
    ServerThreaded.h \
    ../QtWebsocket/QWsSocket.h \
    ../QtWebsocket/QWsServer.h \
    UdpServer.h \
    JsonParser.h \
    /usr/include/mysql/mysql.h

LIBS += -L ../QtWebsocket/ -lQtWebsocket -lmyodbc5
