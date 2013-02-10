#!/usr/bin/env python2

import datetime
from urllib2 import urlopen
from sqlalchemy import create_engine
from sqlalchemy.orm import sessionmaker
import json
from ranklist.models import Rank

#~ with open('build/config.json', 'r') as f:
    #~ config = json.load(f)

#~ engine = create_engine('{db_driver}://{db_user}:{db_password}@{db_host}/{db_name}'.format(**config))
# temporary
engine = create_engine('mysql://uppg:pr0gramm3r@localhost/ranklist')
Session = sessionmaker(bind=engine)
session = Session()

users = session.query(Rank)
for user in users:
    if user.uva_uname:
        if not user.uva_id:
            txt = urlopen('http://uhunt.felix-halim.net/api/uname2uid/{0}'.format(user.uva_uname)).read()
            print(txt)
            try:
                user.uva_id = txt
            except IndexError:
                break
    if user.uva_id:
        txt = urlopen('http://uhunt.felix-halim.net/api/ranklist/{0}/0/0'.format(user.uva_id)).read()
        print(txt)
        jmap = json.loads(txt)[0]
        try:
            user.uva_ac = int(jmap['ac'])
            user.uva_nsubs = int(jmap['nos'])
            user.uva_grank = int(jmap['rank'])
            user.uva_last_sub = datetime.datetime.today()
        except IndexError:
            break
    
session.commit()
