#!/usr/bin/perl
use strict;
#usage = perl generate_sample_data.pl > sample_data.csv

my @fnames = ("Adam", "Abraham", "Bill", "Bruce", "Charles", "Doug", "Eric", "Fred", "James", "John","George", "Sean");
my @lnames = ("Adamson", "Bailey", "Cole", "Durbin", "Erickson", "Jennings", "Jones", "Smith", "Jones", "Johnson", "Smith", "Thompson");

my @years = (1900 .. 2000);
my $recordCount = 1000;
print "fname,lname,birth,death\r\n";
for(my $i=0; $i<$recordCount; $i++) {
    my $fNameIndex = int(rand(12));
    my $lNameIndex = int(rand(12));
    my $birthYearIndex = int(rand(90));
    my $isAlive = int(rand(3));
    my $fname = $fnames[$fNameIndex];
    my $lname = $lnames[$lNameIndex];
    my $birthYear = $years[$birthYearIndex];
    my $deathYear = "";
    if($isAlive < 1) {
        my $deathYearIndex = int($birthYearIndex + rand(100-$birthYearIndex));
        $deathYear = $years[$deathYearIndex];
    }
    print "$fname,$lname,$birthYear,$deathYear\r\n";
}
