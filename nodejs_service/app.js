const express = require('express');
const bodyParser = require("body-parser");
const mongoose = require('mongoose');

const app = express();
const port = 3100;

const router = require('./routes/discussion.route')

let dev_db_url = 'mongodb+srv://root:root@nordine-cluster.8xz6d.mongodb.net/micro_service?retryWrites=true&w=majority';
let mongoDB = process.env.MONGODB_URI || dev_db_url;
mongoose.connect(mongoDB, {
    useNewUrlParser: true,
    useUnifiedTopology: true,
    useFindAndModify: false,
    useCreateIndex: true
});
mongoose.Promise = global.Promise;
let db = mongoose.connection;
db.on ('error', console.error.bind(console,'Connexion error on MongoDB : '));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.use("/", router);

app.listen(port, () => console.log(`server running on port: ${port}`))