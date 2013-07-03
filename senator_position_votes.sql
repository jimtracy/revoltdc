create table senator_position_votes as (
  select vote_with_party.VoteId,
         Senators.SenatorId,
         vote_with_party.BillSubject,
         (case when vote_with_party.party_position = vote_with_party.VoteResult then 1 else 0 end) with_party,
         Senators.SenatorFirstName,
         Senators.SenatorLastName,
         Senators.SenatorState,
         Senators.SenatorParty
  from vote_with_party
  join Votes on vote_with_party.VoteId = Votes.VoteId
  join Senators on Votes.SenatorId = Senators.SenatorId)