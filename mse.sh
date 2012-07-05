i=10
while [ "$i" != "0" ]
do
	j=$(($i))
	i=$(($i-1))
	mv "RR"$i".txt" "RR"$j".txt" 
	
done
mv RR.txt RR1.txt

cat RR1.txt RR2.txt RR3.txt RR4.txt RR5.txt RR6.txt RR7.txt RR8.txt RR9.txt RR10.txt > RRList.txt


