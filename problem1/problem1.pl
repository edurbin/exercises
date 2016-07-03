#!/usr/bin/perl
use strict;
use DBI;
use Text::Table;
#usage = perl problem1.pl > output.txt

my $outputTable = Text::Table->new("YEAR\n-----", "|", "COUNT\n-----");

my $dbh = DBI->connect("DBI:CSV:file=sample_data.csv") or die "Cannot connect: " . $DBI::errstr;
my $sth = $dbh->prepare("SELECT birth, count(birth) as headcount FROM sample_data.csv WHERE death IS NULL group by birth ORDER by headcount DESC");
$sth->execute() or die "Cannot execute: " . $sth->errstr();
while(my $row = $sth->fetchrow_hashref) {
    $outputTable->add($row->{"birth"}, "|", $row->{"headcount"});
}
$sth->finish();
$dbh->disconnect();
print $outputTable;
