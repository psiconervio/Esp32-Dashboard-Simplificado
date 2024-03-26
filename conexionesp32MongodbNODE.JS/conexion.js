const express = require('express');
const bodyParser = require('body-parser');
const mongoose = require('mongoose');

mongoose.connect('mongodb+srv://<username>:<password>@cluster0.mongodb.net/test?retryWrites=true&w=majority', {useNewUrlParser: true, useUnifiedTopology: true});

const SensorData = mongoose.model('SensorData', new mongoose.Schema({
  sensor1: Number,
  sensor2: Number
}));

const app = express();
app.use(bodyParser.urlencoded({ extended: false }));

app.post('/api/data', (req, res) => {
  const data = new SensorData({
    sensor1: req.body.sensor1,
    sensor2: req.body.sensor2
  });
  data.save().then(() => console.log('Data saved to MongoDB Atlas.')).catch(err => console.log(err));
  res.sendStatus(200);
});

app.listen(3000, () => console.log('Server listening on port 3000.'));
