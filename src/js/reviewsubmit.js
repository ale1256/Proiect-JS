const review= document.getElementById('review');
 
review.innerHTML = `
  <h2>Review Submitted Successfully</h2>
    <div id="submitted-info">
    </div>
    `;

    const urlParams = new URLSearchParams(window.location.search);
    const name = urlParams.get('name');
    const restname = urlParams.get('restname');
    const city = urlParams.get('city');
    const rate = urlParams.get('rate');
    const subject = urlParams.get('subject');

    const submittedInfo = document.getElementById('submitted-info');
    submittedInfo.innerHTML = `
        <p><strong>Name:</strong> ${name || "N/A"}</p>
        <p><strong>Restaurant Name:</strong> ${restname || "N/A"}</p>
        <p><strong>City:</strong> ${city || "N/A"}</p>
        <p><strong>Rating:</strong> ${rate || "N/A"}</p>
        <p><strong>Review:</strong> ${subject || "N/A"}</p>
        
`;