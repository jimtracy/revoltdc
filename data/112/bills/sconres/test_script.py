import json, os

dir_path = '/root/congress/data/112/bills/sconres/'

path_file = [x for x in open('path_file.txt','r')]

for path in path_file:
    full_path = dir_path + path.rstrip()

    file = open(full_path+'/data.json','r').read()
    text = json.loads(file)

    bill_id = str(text['bill_id'])
    top_subject = str(text['subjects_top_term'])
    top_subject = top_subject.replace(',','')
    bill_date = str(text['status_at'])
    actions = text['actions']

    for action in actions:
        try:
           result = str(action['result'])
        except:
            pass

    title = str(text['official_title'])
    title = title.replace(',','')
    title = title.replace('.','')

    new_file = open(dir_path+path.rstrip()+'.csv','w')
    new_file.write(bill_id+','+top_subject+','+bill_date+','+title+','+result+'\n')
    new_file.close()
