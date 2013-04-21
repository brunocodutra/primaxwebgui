#!/bin/bash

# This file is part of primaxwebgui, a free software.
# Use, modification and distribution is subject to the BSD 2-clause license.
# See accompanying file LICENSE.txt for its full text.

if g++ cpp/primaxscan.cpp -o php/primaxscan && chown root php/primaxscan && chmod u=rwx,go=xr,+s php/primaxscan
then    
    echo "instalation successful!"
    exit 0;
else
    echo "instalation failed (forgot root privileges?)"
    exit 1;
fi