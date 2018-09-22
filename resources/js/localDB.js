class localDB {

    get(key){
        // console.log(key);
        if(!localStorage.getItem(key)){
            return false;
        }

        return JSON.parse(localStorage.getItem(key));
    }

    set(key, value){

        localStorage.setItem(key, JSON.stringify(value));

    }
}

export default localDB;