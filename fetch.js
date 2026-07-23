//fetching the json php gives us
async function fetchData() {

    try{
        const response = await fetch('api.php');

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        console.log(data);
        
    }
    catch(error){
        console.error(error);
    }
}

fetchData();