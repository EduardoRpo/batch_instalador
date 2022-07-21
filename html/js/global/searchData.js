$(document).ready(function() {

    searchData = async(urlApi) => {
        //let result
        try {
            result = await $.ajax({ url: urlApi })
            return result
        } catch (error) {
            console.error(error)
        }
    }

});