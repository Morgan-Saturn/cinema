const parentElement = document.querySelector(".movie_grid");
const loadMore = document.querySelector('.voir_plus');
let currentPage = 0;

//fetching the json php gives us
async function fetchData(currentPage) {

    try{
        const response = await fetch(`api.php?page=${currentPage}`);

        if(!response.ok) {
            throw new Error("Couldn't fetch resource");
        }

        const data = await response.json();
        let html = '';
        for (const item of data.news) {
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
        parentElement.innerHTML += html;
        
        
    }
    catch(error){
        console.error(error);
    }
}

fetchData(currentPage);

loadMore.addEventListener('click', () => {
    currentPage ++;
    fetchData(currentPage);
});
