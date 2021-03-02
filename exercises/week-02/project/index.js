// let  scoresTotal = 0;
// let count = 0;
// axios.get('http://localhost:8080/checkins')
//     .then(function (response) {
//         if (response.data.length == 0){
//             $('#checkins').append(
//                 '<div class="p-3 m-3 border">'+
//                 '<p class="text-warning">No reviews on this shop yet, be the first to review!</p>'+
//                 '</div>');
//         };
//         response.data.forEach((item) => {
//             scoresTotal += item.rating;
//             count++
//             $('#checkins').append(
//                 '<div class="p-3 m-3 border">'+
//                 '<h3>'+item.name+' '+star(item.rating)+'</h3>'+
//                 '<p>'+item.review+'</p>'+
//                 '<p><small>'+item.dateTime+'</small></p>'+
//                 '</div>'
//             );
//         });
//         updateOverallRating(scoresTotal, count);
//     })
//     .catch(function (error){
//         console.log(error);
//         updateOverallRating(scoresTotal, count);
//     })
// function star(rate) {
//     let starRating = '';
//     rate = parseInt(rate);
//     let increment = 0;
//     let max = 5;
//     while(increment < rate) {
//         starRating += '<i class="fas fa-star fa-xs text-warning "></i>';
//         increment++;
//     }
//     while(max > rate) {
//         starRating += '<i class="fas fa-star fa-xs text-secondary"></i>';
//         max--;
//     }
//     return starRating;
// };
// function updateOverallRating(scores, total){
//     let average = Math.round(scores / total);
//     if (average > 0){
//         $('#overallRating').replaceWith(star(average));
//     } else {
//         $('#overallRating').replaceWith(
//             '<i class="fas fa-star fa-xs text-secondary"></i>'+
//             '<i class="fas fa-star fa-xs text-secondary"></i>'+
//             '<i class="fas fa-star fa-xs text-secondary"></i>'+
//             '<i class="fas fa-star fa-xs text-secondary"></i>'+
//             '<i class="fas fa-star fa-xs text-secondary"></i>'
//         );
//     }
// }