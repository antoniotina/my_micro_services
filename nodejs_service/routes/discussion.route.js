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
    console.log()
    if(req.query.id){
        let response = await Cdiscussion.findDiscussionById(req.query.id);
        res.send(response);
    } else {
        let response = await Cdiscussion.findDiscussion();
        res.send(response);
    }
});

// Update
router.route('/update').put(validator.update, async (req, res) => {
    console.log(req.body)
    if(req.body.id){
        let reponse = await Cdiscussion.updateDiscussion(req.body)
        res.send(reponse);
    }
    else {
        res.send('id missing')
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