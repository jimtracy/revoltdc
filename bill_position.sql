create table bill_position as (
	select 
        BillId,
        (case when dem_yes > dem_no then 'yes' else 'no' end) dem_position,
        (case when gop_yes > gop_no then 'yes' else 'no' end) gop_position 
        from bill_partisan)