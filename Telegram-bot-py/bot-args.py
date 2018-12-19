from telegram.ext import Updater, CommandHandler
updater = Updater('*372838934:AAHGxsI7iF9BUNxJUswCUYvtPDnuioJPumc*') # API Without astrinks

def start_method(bot,update,args):
    bot.sendMessage(update.message.chat_id,"Welcome "+str(args[0])) # /start Hadi Abedzadeh

start_command = CommandHandler('start',start_method,pass_args=True)
updater.dispatcher.add_handler(start_command)
print("Worked")

updater.start_polling()
updater.idle()
