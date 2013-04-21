/*
  This file is part of primaxwebgui, a free software.
  Use, modification and distribution is subject to the BSD 2-clause license.
  See accompanying file LICENSE.txt for its full text.
 */

#include <sys/types.h>
#include <unistd.h>

#include <cstdlib>
#include <string>
#include <fstream>

int main(int argc, char *argv[])
{
    setuid (0);
    
    std::string cmd("/usr/bin/primaxscan");
    for(std::size_t i = 1; i < argc; ++i)
        cmd += std::string(" ") + std::string(argv[i]);
    
    std::ofstream log("primaxscan.log");
    log << cmd << std::endl;
    return system(cmd.c_str());
} 
