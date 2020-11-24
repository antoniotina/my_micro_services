module.exports = {
    create: (req, res, next) => {
        if(!req.body.name) return res.send('Name is required');
        if(req.body.name.length < 3 || req.body.name.length > 16) return res.send('Name must be between 3 and 16 caracters');
        if(!Array.isArray(req.body.users) || req.body.users.length < 2) return res.send('A discussion need 2 users');
        next();
    },
    update: (req, res, next) => {
        if(!req.body.users) return res.send('users needed to update the discussion');
        if(req.body.users.length < 2) return res.send('A discussion need 2 users');
        next();
    }
}