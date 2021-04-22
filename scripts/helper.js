// all js functionss needed

// a countdown helper function
function countdown(){

    var count, counter, timer;
    count = 5; //seconds
    counter = setInterval(timer, 1000);

    function timer() {
        'use strict';
        if (count < 0) {
            clearInterval(counter);
            return;
        }
        document.getElementById("timer").innerHTML = "Redirecting in " + count + " seconds";

        count = count - 1;
    }

}
