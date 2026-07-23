const parentElement = document.querySelector(".movie_grid");
const loadMore = document.querySelector('.voir_plus');
/*let page = 3;
const resultsPerPage = 3;
const skip = page - 1 * resultsPerPage;
const allNewsUrl = 'http://localhost/cinema/index.html?'
const paginatedUrl = `http://localhost/cinema/index.html?limit=${resultsPerPage}&skip=${skip}`;*/

//fetching the json php gives us
async function fetchData() {

    try{
        const response = await fetch('api.php');

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = '';
        for (const item of data) {
            html += `
                <div class='movie'>
                    <img class='movie_img' src='${item.img}' style='width: 100%; height: 100%;' alt='affiche du film'>
                    <h3 class='categories'>
                        <a href='${item.link}'>${item.title}</a>
                    </h3>
                    <p class='summary'>${item.description}</p>
                </div>
                `;
        }
        parentElement.innerHTML = html;
        pagination(data);
        
    }
    catch(error){
        console.error(error);
    }
}

fetchData();

function pagination(data) {
    const allNews = data.length;
    const resultsPerPage = 3;

    //ceil car cette division peut avoir un reste
    const pageTotal = Math.ceil(allNews / resultsPerPage);

    console.log(allNews);
    console.log(resultsPerPage);
    console.log(pageTotal);
    
    
    // je m'assure qu'on ne puisse pas avoir un nombre de pages plus grand que ce qui existe déjà au maximum
    let currentPage = 1;
    if (currentPage > pageTotal) {
        currentPage = pageTotal;
    }
}


