## First step
1. Clone project
2. Create database and user that you will use in project
3. Run composer install 
4. Update database (Run command in terminal bin/console doctrine:schema:update --force)
---

## Run project
Run command bin/console server:start

After that go to link http://localhost:8000

## Save request

**Fields that save to database:** 
```text
    - headers (Request headers);
    - body (Request body);
    - route (Route of request URI);
    - method (HTTP method of request);
    - IP (IP of client);
    - created (date and time of request);
   ``` 

**__For example make request:__**
- **Request:** http://localhost/storeRequest/first
- **Response:** {‘Success’: true, ‘id’: 45} or {‘Success’: false, ‘Message’: ‘reason of fail’}

## Get Return requests

Get Return all saved requests or that matches filter conditions

**All available filters:**
   ```text
      - id - Id of record;
      - route - Route of request;
      - method - Request method;
      - ip - Client IP;
      - last_days - count of days. Filter by period: now-last_days to now;
      - search - string value. return records that contains ‘search’ string in headers or body.
   ``` 
  Filter logic: AND.
  
  Result response format: JSON

**__For example make request:__**

  - **Request:** 
  ```text
     http://localhost/getRequest/?method=GET
  ``` 
  - **Response:**
  ```json
  [
    {
        "id": 4,
        "headers": "Accept:...",
        "body": "",
        "route": "second",
        "method": "GET",
        "ip": "127.0.0.1",
        "createdAt": {
            "date": "2017-11-27 10:33:02.000000",
            "timezone_type": 3,
            "timezone": "Europe\/Kiev"
        }
    }
  ]
  ```