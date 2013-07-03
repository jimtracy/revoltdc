create table vote_with_party as (
	select Votes.VoteId,
        	Senators.SenatorParty,
                Votes.BillId,
                (case when Senators.SenatorParty = 'D' then bill_position.dem_position 
                 when Senators.SenatorParty = 'R' then bill_position.gop_position
                 end ) party_position,
                Votes.VoteResult,
                Bills.BillSubject 
                from Votes join Bills on Votes.BillId = Bills.BillId
                  join Senators on Votes.SenatorId = Senators.SenatorId
                  join bill_position on Votes.BillId = bill_position.BillId 
                where Votes.Category = 'passage'
      )
                