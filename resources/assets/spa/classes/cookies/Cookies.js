/**
 * Created by ArroWs on 03.05.2017.
 */
export default class Cookies {
    constructor(){
        let cookies = document.cookie ? document.cookie.split('; ') : []

        cookies.forEach( value => {
            let chunks = value.split('=')
            this[chunks[0]] = chunks[1]
        })
    }


    any(){
        return Object.keys(this).length > 0
    }


    has(name){
        return this.hasOwnProperty(name)
    }


    get(name){
        if(this.has(name))
            return this[name]
    }


    all(){
        if(this.any()){
            let cookies = {}
            Object.keys(this).forEach(value => {
                cookies[value] = this[value]
            })
            return cookies
        }
    }


    set(name, value, expire=null, path='/'){
        this[name] = value
        let cookie = `${name}=${value};`

        if(expire !== null)
            cookie += `expires=${this.getExpire(expire)};`

        cookie += `path=${path}`

        document.cookie = cookie
    }


    delete(name){
        if(this.has(name)){
            this.set(name, null, -1)
            delete this[name]
        }
    }


    getExpire(days){
        if (typeof days === 'number') {
            let expires = new Date()
            expires.setMilliseconds(expires.getMilliseconds() + days * 864e+5)
            return expires.toUTCString()
        }
    }
}