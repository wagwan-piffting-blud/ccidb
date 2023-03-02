#!/usr/bin/env python3

import cv2, zxingcpp, sys

img = cv2.imread(str(sys.argv[1]))
results = zxingcpp.read_barcodes(img)

for result in results:
	if len(results) == 1:
		print("Barcode: {}".format(result.text))
	else:
		print("Too many barcodes. Please take a picture of only one at a time and try again.")

if len(results) == 0:
	print("No barcodes detected. Please take a new picture and try again.")
