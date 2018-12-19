from telegram.ext import Updater, CommandHandler
updater = Updater('*372838934:AAHGxsI7iF9BUNxJUswCUYvtPDnuioJPumc*') # API Without astrinks


def sendphoto_method(bot,update):
    chat_id = update.message.chat_id
    photo = open('picture.jpg','rb') # Read binary
    bot.sendPhoto(chat_id,photo)
    photo.close()

photo_command = CommandHandler('sendphoto',sendphoto_method)
updater.dispatcher.add_handler(photo_command)
print("Worked")

updater.start_polling()
updater.idle()

