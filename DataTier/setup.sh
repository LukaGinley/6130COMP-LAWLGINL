echo "Creating MongoDB database..."

sleep 10

# Create a mongodb replica set
mongosh --host Data-Mongo1:27017 <<EOF
var config = {
    "_id": "rs0",
    "version": 1,
    "members": [
        {
            "_id": 0,
            "host": "Data-Mongo1:27017",
            "priority": 2
        },
        {
            "_id": 1,
            "host": "Data-Mongo2:27017",
            "priority": 0
        },
        {
            "_id": 2,
            "host": "Data-Mongo3:27017",
            "priority": 0
        }
    ]
};
rs.initiate(config, { force: true });
EOF

sleep 5

mongosh --host Data-Mongo1:27017 < /database/init.js