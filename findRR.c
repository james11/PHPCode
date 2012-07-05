//---------------------------------------------------------------------------
//#include <iostream>
//#pragma  hdrstop
#include <stdio.h>
#include <string.h>
//---------------------------------------------------------------------------
int   data_analyzing (double* data,double* slopeRRHIGH,int* offset2);    
int   find_localmax (double* dataslopedet);    
int   write_rrinterval (int flagH,int count1,int* indexslope1,int t,int offset111,int offset2,int* index,int* index1,double* RRinterval); 
unsigned long GetFileLength ( FILE * fileName);
void  modify (void); 
int   count1=0;
int   counter1=0;
  
////////////////////////////////////////////////////////////////////////////////
//int double
main(int argc, char *argv[ ]) 
{
int  offset2=0;
char input[100]={0};
char output[100]={0};
int  interval;
double RRinterval[4000]={0};
double slopeRRHIGH[4000]={0};
double dataslopedet[2000]={0};
double data[4000]={0};   
int indexslope1[4000]={0};
int index[4000]={0};
int index1[4000]={0};
int intervalslope=300;
int offset111=0;
int flag=0;
int t=0;
int i=0;
int ccc=0;
unsigned long len=0;
int filecount=0;
////////////////////////////////////////////////////////////////////////////////
//iostream
FILE *fp_r;
char ch;       

if(argc>1)      
{
fp_r=fopen(argv[1],"r");        
if(fp_r!=NULL)     {
printf("File Opening success!!\n");
printf("%s\n",argv[2]);
}
else{ 
printf("File Opening Failure!!\n");
}
}


////////////////////////////////////////////////////////////////////////////////
//read and write name
printf ("Start\n");
//scanf("%s", &input);
//scanf("%s", &output);
fp_r=fopen(argv[1],"r");  
FILE *fp_wRRinterval;
FILE *fp_wRRsameple;
fp_wRRinterval=fopen(argv[2],"w");  
fp_wRRsameple=fopen(argv[3],"w"); 
////////////////////////////////////////////////////////////////////////////////
len=GetFileLength(fp_r);
filecount=len/150;
printf("%d\n",filecount);
////////////////////////////////////////////////////////////////////////////////
//read ECG signal 19200_ECG.txt
for(t=0;t<filecount;t++){        
for(i=0;i<4000;i++){
fseek(fp_r,150*t+i,0);
ccc=fgetc(fp_r)-48;
data[i]=ccc;
}
////////////////////////////////////////////////////////////////////////////////
flag=data_analyzing(data,slopeRRHIGH,&offset2);
////////////////////////////////////////////////////////////////////////////////
if(flag==1){
count1=count1+1;
indexslope1[count1]=150*t+offset2;
for(i=0;i<intervalslope;i++){
fseek(fp_r,indexslope1[count1]-150+i,0);
ccc=fgetc(fp_r)-48;
dataslopedet[i]=ccc;
}
}
////////////////////////////////////////////////////////////////////////////////
offset111=find_localmax(dataslopedet);
interval=write_rrinterval(flag,count1,indexslope1,t,offset111,0,index,index1,RRinterval);
////////////////////////////////////////////////////////////////////////////////
modify(); 
////////////////////////////////////////////////////////////////////////////////
if(flag==1){
if(RRinterval[counter1]!=0 && index1[counter1]!=0){
counter1++;
}
}
}


for(i=1;i<counter1-1;i++){ 
RRinterval[i]=index1[i]-index1[i-1];
RRinterval[i]=RRinterval[i]/1920;
printf("%06f \t %06d\t %06d\n",RRinterval[i],index1[i],i);
fprintf(fp_wRRinterval,"%f\n",RRinterval[i]);
fprintf(fp_wRRsameple,"%06d\n",index1[i]);
}

//system("mse <RR.txt >mse.txt");
printf("done");
fclose(fp_r);
fclose(fp_wRRinterval);
fclose(fp_wRRsameple);
//while(1);
}
////////////////////////////////////////////////////////////////////////////////






/////////////////////////////////////////////////////////////////////////////////////////
// data fubtion
int  data_analyzing (double* data,double* slopeRRHIGH,int* offset2){
int i=0;   
int j=0; 
double data_mov[4000]={0};
double aaa=0;
double slopeRR[4000]={0};
double max1=0;
int offsetmax1=0;
double max2=0;
int offsetmax2=0;
double max3=0;
int offsetmax3=0;
int flagH=0;


//moving avg
for(i=0;i<4000;i++){
data_mov[i]=(data[i+4]+data[i+3]+data[i+2]+data[i+1]+data[i])/5;
}    

//slope and squar
for(i=0;i<4000;i++){
slopeRR[i]=(2*data[i+3]+data[i+2]-data[i+1]-2*data[i])/8;
slopeRR[i]=slopeRR[i]*slopeRR[i];
}

//slope moving avg
for(i=0;i<4000;i++){
slopeRR[i]=slopeRR[i+31]+slopeRR[i+30]+slopeRR[i+29]+slopeRR[i+28]+slopeRR[i+27]+slopeRR[i+26]+slopeRR[i+25]+slopeRR[i+24]+slopeRR[i+23]+slopeRR[i+22]+slopeRR[i+21]+slopeRR[i+20]+slopeRR[i+19]+slopeRR[i+18]+slopeRR[i+17]+slopeRR[i+16]+slopeRR[i+15]+slopeRR[i+14]+slopeRR[i+13]+slopeRR[i+12]+slopeRR[i+11]+slopeRR[i+10]+slopeRR[i+9]+slopeRR[i+8]+slopeRR[i+7]+slopeRR[i+6]+slopeRR[i+5]+slopeRR[i+4]+slopeRR[i+3]+slopeRR[i+2]+slopeRR[i+1]+slopeRR[i];
slopeRR[i]=10*slopeRR[i]/32;
}

//threhold 
for(i=0;i<4000;i++){
aaa=slopeRR[i]+aaa;
}
aaa=aaa/1950;


//threhold substact
for(i=0;i<4000;i++){
slopeRRHIGH[i]=slopeRR[i]-aaa;
}


//threhold substact
for(i=0;i<4000;i++){
if(slopeRRHIGH[i]<0){
slopeRRHIGH[i]=0;
}
else{
slopeRRHIGH[i]=slopeRRHIGH[i];
}
}


//threhold qua
for(i=0;i<4000;i=i+15){
for(j=0;j<15;j++){
slopeRRHIGH[i+j]=slopeRRHIGH[i];
}
}

//find slope dection
for(i=0;i<350;i++){
if(max1<slopeRRHIGH[i])
{
max1=slopeRRHIGH[i];}
}

for(i=0;i<350;i++){
if(slopeRRHIGH[i]==max1){
offsetmax1=i;
}
}


for(i=350;i<700;i++){
if(max2<slopeRRHIGH[i]){
max2=slopeRRHIGH[i];
}
}

for(i=350;i<700;i++){
if(slopeRRHIGH[i]==max2){
offsetmax2=i;
}
}

for(i=700;i<1050;i++){
if(max3<slopeRRHIGH[i]){
max3=slopeRRHIGH[i];
}
}

for(i=700;i<1050;i++){
if(slopeRRHIGH[i]==max3){
offsetmax3=i;
}
}



//flagR
if(max2-max1>0 && max2-max3>0){
flagH=1;
}
else{
flagH=0;
}
*offset2=offsetmax2;
return flagH;
}    


////////////////////////////////////////////////////////////////////////////////
//find_localmax
int find_localmax (double* dataslopedet){
double max111=0;
int offset111=0;
int intervalslope=300;
int i=0;
for(i=0;i<1950;i++){
dataslopedet[i]=(dataslopedet[i+4]+dataslopedet[i+3]+dataslopedet[i+2]+dataslopedet[i+1]+dataslopedet[i])/5;
}
for(i=0;i<intervalslope;i++){
if(max111<dataslopedet[i]){
max111=dataslopedet[i];
}
}
for(i=0;i<intervalslope;i++){
if(dataslopedet[i]==max111){
offset111=i;
}
}
return offset111;
}     
////////////////////////////////////////////////////////////////////////////////
//detction RRinterval
int  write_rrinterval (int flagH,int count1,int* indexslope1,int t,int offset111,int offset2,int* index,int* index1,double* RRinterval){
int interval=0;
index[count1]=indexslope1[count1]+offset111-150;
index1[counter1]=index[count1];
indexslope1[counter1]=indexslope1[count1];
RRinterval[counter1]=index1[counter1]-index1[counter1-1];
RRinterval[counter1]=RRinterval[counter1]/1920;
return interval;
}
////////////////////////////////////////////////////////////////////////////////
void  modify (void){
}
////////////////////////////////////////////////////////////////////////////////
unsigned long GetFileLength ( FILE * fileName)
{ 
unsigned long pos = ftell(fileName); 
unsigned long len = 0; 
fseek ( fileName, 0L, SEEK_END ); 
len = ftell ( fileName ); 
fseek ( fileName, pos, SEEK_SET ); 
return len; 
}
////////////////////////////////////////////////////////////////////////////////





