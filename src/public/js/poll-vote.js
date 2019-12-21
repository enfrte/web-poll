//console.log(window.location.href);

const submitVote = async (value) => {
  // there are different ways to use the Fetch API to send data to PHP, but this is how I currently prefer to do it. 
  let formData = new FormData(); // create a form
  formData.append('vote', value); // create a form field

  try {
    let postVote = await fetch('src/Backend/postHandler.php', {
      method: 'POST',
      body: formData
    });
    let result = await postVote.text();
    console.log('result:',result);
    document.querySelector('#debug').innerHTML = result;
  } catch (error) {
    console.error(error);
  }
};

const displayResults = async () => {
  let voteResults = await fetch('src/Backend/viewResults.php');
  let result = await voteResults.text();
  console.log(result);
};

const resultsTemplate = `<div class="web-poll-vote-candidate"></div>
<div class="web-poll-vote-percent-bar">
  <div class="web-poll-vote-percent-value">
    _{percent}
  </div>
</div>`;

// events for radio buttons
const radioButton = document.querySelectorAll('input[type=radio][name=web-poll-vote]');
const getVote = (el) => {
  console.log('getVote:', el.target.value);
  submitVote(el.target.value);
};
radioButton.forEach((el) => {
  el.addEventListener('change', getVote);
});
