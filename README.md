# ElasticSearch-in-PHP

보안위해 controller 한장만 업로드

실행시키기 위한 순서

  1. https://www.elastic.co/ 에서 엘라스틱서치 라이브러리 다운로드
  2. terminal에서
  
  >

    composer require elasticsearch/elasticsearch

    
    명령어로 다운로드

  3. DB접속 후 crowling 메서드에서 인덱싱시키기

이렇게 되면 mysql에서 바로 값을 가져오는 것이 아니라
elastic search에 인덱싱 한 값들을 넣어둔 후에 엘라스틱 서치에서 가져오는 것.
