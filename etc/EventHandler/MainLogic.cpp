#include <MainLogic.h>

/**
 * @brief MainLogic::MainLogic
 */
MainLogic::MainLogic()
{
    qDebug("MainLogic::MainLogic() start ");
}

/**
 * @brief MainLogic::~MainLogic
 */
MainLogic::~MainLogic()
{
}

/**
 * @brief MainLogic::execute
 */
void MainLogic::execute()
{
    qDebug("execute() start");

    webSocketServer.init();
    ipsServer.initReceiveSock();
}
