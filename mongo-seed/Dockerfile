FROM mongo

COPY init.json /init.json
CMD mongoimport --host mongo_database --db silexexample --collection users --type json --file /init.json --jsonArray