drop table bill_partisan;

create table bill_partisan as (

select distinct Bills.BillId,
	sum(case when Votes.VoteResult = 1 and Senators.SenatorParty = 'D' then 1 else 0 end) dem_yes,
        sum(case when Votes.VoteResult = 0 and Senators.SenatorParty = 'D' then 1 else 0 end) dem_no,
        sum(case when Votes.VoteResult = 1 and Senators.SenatorParty = 'R' then 1 else 0 end) gop_yes,
        sum(case when Votes.VoteResult = 0 and Senators.SenatorParty = 'R' then 1 else 0 end) gop_no
from Bills
join Votes
on Bills.BillId = Votes.BillId
join Senators
on Votes.SenatorId = Senators.SenatorId
where Votes.Category = 'passage'
group by 1
)