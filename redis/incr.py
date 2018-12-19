# pip install redis
# pip install requests

import requests
import redis

pool = redis.ConnectionPool(host='127.0.0.1', port=6379, db=0)
redis = redis.Redis(connection_pool=pool)
while 1 < 50: # Counter loop for get feresh data
	web = requests.post("http://api.systemcode.ir/API/free/LeadersSpeech", data={'Hadi-Abedzadeh':'' })
	print(web.status_code, web.reason)
	redis.incr(web.text)

# REDIS SERVER- SHOW ALL KEYS: KEYS *
