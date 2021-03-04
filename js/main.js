// ----------------------move to scroll

document.addEventListener('DOMContentLoaded', () => {
const hero = document.querySelector('.bottom-img');
const header = document.querySelector('.navbar');
const scrollItems = document.querySelectorAll('.scroll-item');

const scrollAnimation = () => {
  let windowCenter = (window.innerHeight / 2) + window.scrollY;
  console.log(windowCenter)
  scrollItems.forEach(el => {
    let scrollOffset = el.offsetTop + (el.offsetHeight / 2);
    if (windowCenter >= scrollOffset) {
      el.classList.add('animation-class');
    } else {
      el.classList.remove('animation-class');
    }
  });
};

const headerFixed = () => {
  let scrollTop = window.scrollY;
  let heroCenter = hero.offsetHeight / 2;

  if (scrollTop >= heroCenter) {
    header.classList.add('fixed')
    hero.style.marginTop = `${header.offsetHeight}px`;
  } else {
    header.classList.remove('fixed')
    hero.style.marginTop = `0px`;
  }
};

headerFixed();
scrollAnimation();
window.addEventListener('scroll', () => {
  headerFixed();
  scrollAnimation();
});
});

//-------------------- portfolio-section
// scrolling
  var scroll = window.requestAnimationFrame ||

  function(callback){ window.setTimeout(callback, 1000/60)};
  var elementsToShow = document.querySelectorAll('.show-on-scroll');

  function loop() {

	Array.prototype.forEach.call(elementsToShow, function(element){
	  if (isElementInViewport(element)) {
	    element.classList.add('is-visible');
	  } else {
	    element.classList.remove('is-visible');
	  }
	});

	scroll(loop);
  }


  loop();


function isElementInViewport(el) {

  if (typeof jQuery === "function" && el instanceof jQuery) {
    el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
    (rect.top <= 0
      && rect.bottom >= 0)
    ||
    (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight))
    ||
    (rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
  );
}


$(document).ready(function(){
  $('.slider').slick({
    infinite: true,
    slidesToShow: 2,
    slidesToScroll: 2,
    responsive: [
    {
      breakpoint: 920,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1,
      }
    }]
  });

});




  const meIcon = new Vivus(
      'me',
      {
          type: 'sync',
          duration: 200
      }
  );
  // Фильтр контента по категориям на чистом Javascript

  function app() {
    const buttons = document.querySelectorAll('.button')
    const cards = document.querySelectorAll('.card')

    function filter (category, items) {
        items.forEach((item) => {
            const isItemFiltered = !item.classList.contains(category)
            const isShowAll = category.toLowerCase() === 'all'
            if (isItemFiltered && !isShowAll) {
                item.classList.add('anime')
            } else {
                item.classList.remove('hide')
                item.classList.remove('anime')
            }
        })
    }

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            const currentCategory = button.dataset.filter
            filter(currentCategory, cards)
        })
    })

    cards.forEach((card) => {
        card.ontransitionend = function () {
            if (card.classList.contains('anime')) {
                card.classList.add('hide')
            }
        }
    })
  }

  app()


  // ---------------------------ToDo list


  // getting all required elements
const inputBox = document.querySelector(".inputField input");
const addBtn = document.querySelector(".inputField button");
const todoList = document.querySelector(".todoList");
const deleteAllBtn = document.querySelector(".todo-footer button");

// onkeyup event
inputBox.onkeyup = ()=>{
  let userEnteredValue = inputBox.value; //getting user entered value
  if(userEnteredValue.trim() != 0){ //if the user value isn't only spaces
    addBtn.classList.add("active"); //active the add button
  }else{
    addBtn.classList.remove("active"); //unactive the add button
  }
}

showTasks(); //calling showTask function

addBtn.onclick = ()=>{ //when user click on plus icon button
  let userEnteredValue = inputBox.value; //getting input field value
  let getLocalStorageData = localStorage.getItem("New Todo"); //getting localstorage
  if(getLocalStorageData == null){ //if localstorage has no data
    listArray = []; //create a blank array
  }else{
    listArray = JSON.parse(getLocalStorageData);  //transforming json string into a js object
  }
  listArray.push(userEnteredValue); //pushing or adding new value in array
  localStorage.setItem("New Todo", JSON.stringify(listArray)); //transforming js object into a json string
  showTasks(); //calling showTask function
  addBtn.classList.remove("active"); //unactive the add button once the task added
}

function showTasks(){
  let getLocalStorageData = localStorage.getItem("New Todo");
  if(getLocalStorageData == null){
    listArray = [];
  }else{
    listArray = JSON.parse(getLocalStorageData);
  }
  const pendingTasksNumb = document.querySelector(".pendingTasks");
  pendingTasksNumb.textContent = listArray.length; //passing the array length in pendingtask
  if(listArray.length > 0){ //if array length is greater than 0
    deleteAllBtn.classList.add("active"); //active the delete button
  }else{
    deleteAllBtn.classList.remove("active"); //unactive the delete button
  }
  let newLiTag = "";
  listArray.forEach((element, index) => {
    newLiTag += `<li>${element}<span class="icon" onclick="deleteTask(${index})">-</i></span></li>`;
  });
  todoList.innerHTML = newLiTag; //adding new li tag inside ul tag
  inputBox.value = ""; //once task added leave the input field blank
}

// delete task function
function deleteTask(index){
  let getLocalStorageData = localStorage.getItem("New Todo");
  listArray = JSON.parse(getLocalStorageData);
  listArray.splice(index, 1); //delete or remove the li
  localStorage.setItem("New Todo", JSON.stringify(listArray));
  showTasks(); //call the showTasks function
}

// delete all tasks function
deleteAllBtn.onclick = ()=>{
  listArray = []; //empty the array
  localStorage.setItem("New Todo", JSON.stringify(listArray)); //set the item in localstorage
  showTasks(); //call the showTasks function
}
