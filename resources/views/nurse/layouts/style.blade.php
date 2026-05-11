<style type="text/css">
.countdown-container {
    -webkit-font-smoothing: antialiased;
    /* width: 100%; */
    /* height: 100%; */
    /* position: absolute; */
    /* top: 50%; */
    /* left: 50%; */
    /* transform: translate(-50%, -50%); */
    text-align: center;
    /* width: 100%; */
    margin-top: 0px;
    background: #2d61e7;
    height: 3.5em;
    border-radius: 12px;
    padding: 0px 0px;
}

.countdown2 {
  display: flex;
  transform-style: preserve3d;
  perspective: 500px;
  height: auto;
  /*width: 64em;*/
  margin: 0 auto;
}
.countdown2.remove {
  animation: hide-countdown 1s cubic-bezier(0, 0.9, 0.56, 1.2) forwards;
  overflow: hidden;
}

.number, .separator {
    display: block;
    color: #fff;
    height: auto;
    font-size: 20px;
    position: relative;
    line-height: normal;
    text-align: center;
    width: 70px;
}

.separator {
    margin: 0;
    width: auto;
}

.new, .old, .current {
  color: #fff;
  position: absolute;
  border-radius: 1rem;
  height: auto;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
}

.new {
  animation: show-new 0.4s cubic-bezier(0, 0.9, 0.5, 1.2) forwards;
}

.old {
  animation: hide-old 2s cubic-bezier(0, 0.9, 0.56, 1.2) forwards;
}

.countdown2 section {
  position: relative;
}

.number:after, .number:after, .number:after, .number:after {
  content: "DAYS";
  position: absolute;
  text-align: center;
  left: 0;
  right: 0;
  bottom: -14px;
  font-size: 11px;
}
#hours:after {
  content: "HOURS";
}
#minutes:after {
  content: "MINUTES";
}
#seconds:after {
  content: "SECONDS";
}
@keyframes hide-countdown {
  to {
    height: 0;
    overflow: hidden;
  }
}
@keyframes show-new {
  0% {
    opacity: 0;
    transform: translate(-50%, -50%) translateY(-2rem) scale(0.8) rotateX(-20deg);
  }
  100% {
    transform: translate(-50%, -50%);
  }
}
@keyframes hide-old {
  0% {
    transform: translate(-50%, -50%);
  }
  100% {
    opacity: 0;
    transform: translate(-50%, -50%) translateY(-5rem) scale(0.5) rotateX(-75deg);
  }
}


</style>
<div class="modal fade" id="commingsoonModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                             <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">Coming Soon</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
          <div class="modal-body">
                                <p id="paydatadata">Coming Soon</p>
                        </div>
                        <!-- <a href="javascript:void(0);" class="btn btn-sm mybtn p-0 px-2 m-0 " data-bs-dismiss="modal" aria-label="Close" type="button">Ok</a>   -->
                </div>
        </div>
</div>
<div class="modal fade" id="get_new_plice_checkModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
                <div class="modal-content">
                        <div class="modal-header">
                             <h1 class="modal-title fs-5 fw-semibold" id="exampleModalLabel">GET NEW POLICE CHECK</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
          <div class="modal-body">
                                <p id="paydatadata">A Police Check is a requirement for clinical practice in Australia. As this is also your identity check, uPaged can only accept checks via our preferred partner using the link below. The Police Check costs $42.90, and once you have completed 5 uPaged shifts we will reimburse you this cost if you email your invoice to hello@medica.com. HEADS UP: This will take you up to 15 minutes You’ll need 4 identification documents</p>
                        </div>
                        <!-- <a href="javascript:void(0);" class="btn btn-sm mybtn p-0 px-2 m-0 " data-bs-dismiss="modal" aria-label="Close" type="button">Ok</a>   -->
                </div>
        </div>
</div>

