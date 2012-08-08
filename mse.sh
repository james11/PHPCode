while read fileid
do
fid=$fileid
echo "fid="$fid
done

mv ../../SavedData/$fid/$fid".RRList.txt" ./


i=10
while [ "$i" != "0" ]
do
	j=$(($i))
	i=$(($i-1))
	mv ../../SavedData/$fid/$fid".RR"$i".txt" $fid".RR"$j".txt"
	
done
mv ./$fid".RR.txt" ./$fid".RR1.txt"

cat $fid".RR1.txt" $fid".RR2.txt" $fid".RR3.txt" $fid".RR4.txt" $fid".RR5.txt" $fid".RR6.txt" $fid".RR7.txt" $fid".RR8.txt" $fid".RR9.txt" $fid".RR10.txt" > $fid".RRList.txt"

//mv $fid".RR"* ../../SavedData/$fid/
