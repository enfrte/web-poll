//console.log(window.location.href);
const rootElement = document.querySelector('#webPollBallot');

const submitVote = async (value) => {
  // there are different ways to use the Fetch API to send data to PHP, but this is how I currently prefer to do it. 
  let formData = new FormData(); // create a form
  formData.append('vote', value); // create a form field

  try {
    let postVote = await fetch('src/Backend/postHandler.php', {
      method: 'POST',
      body: formData
    });
    let result = await postVote.json();
    document.querySelector('#debug').innerHTML = result;
    console.log('result:',result.errors);
    if (result.success === false) {
      // display error template
      rootElement.innerHTML = displayError(result);
      return;
    }
  } catch (error) {
    console.error(error);
  }
};

const displayResults = async () => {
  let voteResults = await fetch('src/Backend/resultsHandler.php');
  let results = await voteResults.json();
  //console.log(results);
  let totalVotes = 0;
  for (let [key, value] of Object.entries(results)) {
    totalVotes += value;
  }
  let resultsMarkup = '<div class="ballot-results-container"><h3>Results:</h3>';
  for (result in results) {
    let percent = (100 * results[result] / totalVotes).toFixed(1);
    resultsMarkup += `<div class="ballot-result">
      <p class="web-poll-result-candidate">${result}</p>
      <div class="web-poll-percent-bar" style="width: ${percent}%">
        <div class="web-poll-percent-number">${percent}%</div>
      </div>
    </div>`;
  }
  resultsMarkup += '</div>';
  return resultsMarkup;
};

const displayError = (result) => {
  let errorMarkup = '<div class="web-poll-vote-error"><h4>Whoops!</h4>';
  let errorButtonType;
  for (error in result.errors) {
    errorMarkup += `<p>${result.errors[error]}</p>`;
    if (error === 'duplicateIpAddress') {
      errorButtonType = 'viewResults';
    }
  }
  errorButtonType === 'viewResults' ? errorMarkup += '<button onclick="webPollErrorButton(\'viewResults\')">View results</button></div>' : errorMarkup += '<button onclick="webPollErrorButton(\'tryAgain\')>Try again</button></div>';
  return errorMarkup;
};

const webPollErrorButton = async (type) => {
  if (type === 'viewResults') {
    // show results view
    rootElement.innerHTML = await displayResults();
  } else {
    // return to select view
  }
  
}

// events for radio buttons
const radioButton = document.querySelectorAll('input[type=radio][name=web-poll-vote]');
const getVote = (el) => {
  console.log('getVote:', el.target.value);
  submitVote(el.target.value);
};
radioButton.forEach((el) => {
  el.addEventListener('change', getVote);
});
