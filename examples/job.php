<?php
/**
 * Jobs Example
 *
 */

include_once( dirname( __DIR__ ) . '/lib/job.php' );

// Instantaite Job.
$sample_job = new UsabilityDynamics\Job(array(
  "type" => "sample_job"
));

// Make an Update.
$sample_job->update();

// Complete Job.
$sample_job->complete();

die( '<pre>' . print_r( $_job, true ) . '</pre>' );