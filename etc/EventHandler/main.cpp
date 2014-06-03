#include <QCoreApplication>
#include <QTimer>

#include <MainLogic.h>

/**
 * @brief main
 * @param argc
 * @param argv
 * @return
 */
int main(int argc, char *argv[])
{
    QCoreApplication a(argc, argv);

    MainLogic mainLogic;
    QTimer::singleShot(0, &mainLogic, SLOT(execute()));

    return a.exec();
}
