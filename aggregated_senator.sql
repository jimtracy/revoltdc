create table aggregated_senator as (

select BillSubject, SenatorId, SenatorFirstName, SenatorLastName, SenatorState, SenatorParty,
       count(case when with_party = 0 then with_party end) against_party_votes,
       count(case when with_party = 1 then with_party end) with_party_votes,
       (count(case when with_party = 1 then with_party end) / count(with_party) ) as percent_with_party
from  senator_position_votes 
       )