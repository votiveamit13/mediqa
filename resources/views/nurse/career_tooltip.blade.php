<style>
.profile-match-box {
  font-family: Arial, sans-serif;
  margin: 20px 0;
  padding: 20px;
  border-radius: 8px;
  background-color: #fff3cd; /* yellow background */
  border: 1px solid #ffeeba; /* yellow border */
  color: #856404; /* dark yellow text */
  width: 100%;
  box-sizing: border-box;
  position: relative;
}

.summary{
    font-size:16px;
    color:black;

}

.summary .see-details {
  color: #007bff;
  cursor: pointer;
  text-decoration: underline;
}

.details-box {
  display: none;
  margin-top: 15px;
  padding-top: 15px;
  border-top: 1px solid #ffeeba;
}

.details-box.open {
  display: block;
}

.details-box .close {
  position: absolute;
  top: 10px;
  right: 15px;
  font-size: 20px;
  cursor: pointer;
  color: #856404;
}
</style>

<div class="profile-match-box">
  <div class="summary">
    Your profile match score across all current jobs.
    <span class="see-details">see details</span>
  </div>

  <div class="details-box">
    <span class="close">&times;</span>
    <h6>Overall Match</h6>
    <p>Based on your profile completeness and alignment with the job market in general. It tells you how complete and competitive your profile is overall.</p>

    <h6>Per Job Match</h6>
    <p>Uses the same weights but calculated against a specific employer’s job listing. It tells you how well your profile matches that job.</p>
  </div>
</div>


<script>
const seeDetails = document.querySelector('.see-details');
const detailsBox = document.querySelector('.details-box');
const closeBtn = document.querySelector('.details-box .close');

seeDetails.addEventListener('click', () => {
  detailsBox.classList.toggle('open');
});

closeBtn.addEventListener('click', () => {
  detailsBox.classList.remove('open');
});
</script>
