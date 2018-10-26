let user = window.App.user;

module.exports = { 

    owns (model, prop = 'user_id') {
        //console.log(model, 'MODELLLLL')
        return model[prop] === user.id;
    }
};