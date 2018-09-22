let axios = require('axios');

let BASE_URL = "https://www.googleapis.com/youtube/v3/videos";

module.exports = function (options, callback){
    if(!options.apiKey){
        throw new Error('Youtube video would require a key');
    }

    let params = {
        part: 'snippet',
        key: options.apiKey,
        id: options.videoId,
        type: 'video'
    };

    axios.get(BASE_URL, { params })
        .then(response => {
            // console.log('video response ',  response);
            //if the callback is present, we assume is a function and we pass items to it
            if(callback) {callback(response.data.items)}
            
        }).catch(error => console.error(error));
}