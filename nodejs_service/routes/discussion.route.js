const express = require('express');

const router = express.Router();
const Cdiscussion = require('../controllers/discussion.controller');
const validator = require('../util/validator');
// Create
router.route('/create').post(validator.create, (req, res) => {
    let response = Cdiscussion.createDiscussion(req.body);
    res.send(response)
});

// Read
router.route('/find').get(async (req, res) => {
    console.log(req.body)
    if(req.body.id){
        let response = await Cdiscussion.findDiscussionById(req.body.id);
        res.send(response);
    } else {
        let response = await Cdiscussion.findDiscussion();
        console.log(response)
        res.send(response);
    }
});

// Update
router.route('/update').put(validator.update, (req, res) => {
    if(req.body.id){
        Cdiscussion.updateDiscussion(req.body);
        res.send('Discussion correctly updated');
    }
    else {
        res.send('id not found')
    }
    console.log('update');
});

// Delete
router.route('/delete').delete((req, res) => {
    if(req.body.id) {
        Cdiscussion.deleteDiscussion(req.body.id);
        res.send('Discussion correctly deleted');
    } 
    else {
        res.send('id not found');
    }
    console.log('delete');
});

module.exports = router;