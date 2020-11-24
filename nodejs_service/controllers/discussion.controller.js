const Discussion = require('../models/discussion.model');

module.exports = {
    createDiscussion: ({name, users, messages}) => {
        const discussion = new Discussion({
            name: name,
            users: users,
            createdAt: new Date()
        });
        discussion.save()
        .then(result => { return 'created discussion'; })
        .catch(error => `error ${error.message}`);
    },
    findDiscussion: () => {
        let reponse = Discussion.find().then(discussions => { return discussions; });
        return reponse;
    },
    findDiscussionById: (id) => {
        let reponse = Discussion.findById(id)
        .then(discussions => { return discussions; })
        .catch(error => 'Id not found');
        return reponse;
    },
    updateDiscussion: ({id, users}) => {
        Discussion.findById(id)
        .then((discussion) => {
            discussion.users = users;
            return discussion.save();
        })
        .catch(err => err)
        console.log('update disscusion');
    },
    deleteDiscussion: (id) => {
        let reponse = Discussion.findByIdAndRemove(id)
        .then(() => { return 'discussion deleted' })
        .catch(error => 'Id not found');
        return reponse;
    }
}