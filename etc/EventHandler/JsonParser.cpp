#include "JsonParser.h"
#include <QJsonObject>
#include <QJsonDocument>

/**
 * @brief JsonParser::JsonParser
 */
JsonParser::JsonParser()
{
}

/**
 * @brief JsonParser::newMessage
 */
void JsonParser::newMessage()
{

}

/**
 * @brief JsonParser::read
 * @param rawMessage
 * @return
 */
QString JsonParser::read(const QString &rawMessage)
{
    QJsonDocument json = QJsonDocument::fromJson(rawMessage.toUtf8());
    QJsonObject obj = json.object();
    printf("%s\n", rawMessage.toStdString().c_str());
    return obj.begin().value().toString();
}

/**
 * @brief JsonParser::write
 * @param json
 */
void JsonParser::write(const QJsonObject &json) const
{

}
