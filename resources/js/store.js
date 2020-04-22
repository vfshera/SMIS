export default class Auth {

    constructor(user){
        this.user = user;
    }

    getUserName(){
        return this.user.name;
    }
    getUserMail(){
        return this.user.email;
    }
    getUserAccess(){
        return this.user.email;
    }
}
