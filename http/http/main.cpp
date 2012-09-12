//
//  main.cpp
//  http
//
//  Created by Artur Gurgul on 02.06.2012.
//  Copyright (c) 2012 __MyCompanyName__. All rights reserved.
//

#include <iostream>

#include "Http.h"

int main(int argc, const char * argv[])
{

    Http *http = new Http ( "GET / HTTP/1.1"
                            "Host: host.com"
                            "User-Agent: Mozilla/5.0 (X11; U; Linux i686; pl; rv:1.8.1.7) Gecko/20070914 Firefox/2.0.0.7"
                            "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8"
                            "Accept-Language: pl,en-us;q=0.7,en;q=0.3"
                            "Accept-Charset: ISO-8859-2,utf-8;q=0.7,*;q=0.7"
                            "Keep-Alive: 300"
                            "Connection: keep-alive");
    
    std::cout<<http->getHost()<<"\n";
    
    
    return 0;
}

