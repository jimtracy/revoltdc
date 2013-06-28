
/*
var mysql = require('mysql');
var connection = mysql.createConnection({
  host     : 'localhost',
  user     : 'revolt',
  database : 'revolt',
  password : 'nHJMX2hQreP6yv46',
});

connection.connect();
*/

var fs = require('fs');

//ok for each congress dir in data, for each session dir in votes, and for each vote dir in session
var path = '/root/congress/data';

var congress_ptr = -1;
var session_ptr = -1;
var vote_ptr = -1;

var congresses = ['112'];
var sessions;
var votes;

/*
fs.readdir(path,function(err,lst) {
    congresses = lst;
    congress_ptr = -1;
    next_congress();
});
*/

var is_senators = 0;

next_congress();
function next_congress() {
    congress_ptr++;
    if(congress_ptr==congresses.length) {
        process.exit();
    } 
    var dir = path+'/'+congresses[congress_ptr]+'/votes';
    fs.readdir(dir,function(err,lst) {
        if(err) throw err;
        sessions = lst;
        session_ptr = -1;
        next_session();
    });
}


function next_session() {
    session_ptr++;
    if(session_ptr==sessions.length) {
        next_congress();
        return;
    }
    var dir = path+'/'+congresses[congress_ptr]+'/votes/'+sessions[session_ptr]
    fs.readdir(dir,function(err,lst) {
        if(err) throw err;
        votes = lst;
        vote_ptr = -1;
        next_vote();
    });
}

var vote;
function next_vote() {
    vote_ptr++;
    if(vote_ptr==votes.length) {
        next_session();
        return;
    }
    //console.log('votes',votes);
    //console.log('vote_ptr',vote_ptr);
    var dir = path+'/'+congresses[congress_ptr]+'/votes/'+sessions[session_ptr]+'/'+votes[vote_ptr]+'/data.json';
    fs.readFile(dir,function(err,data) {
        if(err) {
            console.log(votes.length);
            console.log(vote_ptr);
            console.log(err);
            process.exit();
        }
        //console.log(data);
        vote = JSON.parse(data);
        for(var choice in vote.votes) {
            for(var i in vote.votes[choice]) {
                var senator =  vote.votes[choice][i];
                var result;
                if(choice=='Yea') {
                    result = 1;
                } else {
                    result = 0;
                }
                var bill_id = '';
                if(typeof(vote.bill)=='undefined') {
                    bill_id = '';
                } else {
                    bill_id = vote.bill.type+vote.bill.number+'-'+vote.bill.congress;
                }
                if(is_senators) {
                    console.log(senator.id+','+senator.last_name+','+senator.first_name+','+senator.party+','+senator.state);
                } else {
                    console.log('NULL,'+senator.id+','+bill_id+','+result+','+congresses[congress_ptr]+','+sessions[session_ptr]+','+vote.category);
                }
            }
        }
        next_vote();
    });
}

