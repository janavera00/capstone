<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Step;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = new Service;
        $service['name'] = "Relocation Survey"; 
        $service['description'] = "Involves the precise identification of established land and its corners. Its main purpose is to re-establish the boundaries of the lot for which a survey has previously been made, a landowner might need this if the property overlaps with adjoining lots and if the landowner wants to put up a fence on their property.";
        $service->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Client's information";
        $step['stepNo'] = 1;
        $step['description'] = "Collect the client's Full name, Contact number, Home address and Email address.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Required document/s";
        $step['stepNo'] = 2;
        $step['description'] = "Collect any documents from the client, it could be either the land title, tax declaration, or any approved plans.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Conducting Research";
        $step['stepNo'] = 3;
        $step['description'] = "Conduct a research to locate any usable reference points near the subject lot, as well as plans of the subject lot's adjoining properties.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Ready for Survey";
        $step['stepNo'] = 4;
        $step['description'] = "The office is ready to conduct a survey, please expect or request for a suitable schedule of survey. The office will be notifying your property's adjoining lot owners about the survey.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Preparing Documents";
        $step['stepNo'] = 5;
        $step['description'] = "The office is preparing your lot's Sketch Plan or Relocation Plan. Once completed, the office will expect full payment.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Done";
        $step['stepNo'] = 6;
        $step['description'] = "All documents has been submitted.";
        $step->save();

        // Subdivision Survey
        $service = new Service;
        $service['name'] = "Subdivision Survey"; 
        $service['description'] = "The process of splitting a property into smaller parcels of land, the number and size of the smaller lands will be determined by the owner with help of a geodetic engineer or a designer.";
        $service->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Client's information";
        $step['stepNo'] = 1;
        $step['description'] = "Collect the client's Full name, Contact number, Home address and Email address.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Required document/s";
        $step['stepNo'] = 2;
        $step['description'] = "Collect any documents from the client, it could be either the land title, tax declaration, or any approved plans.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Conducting Research";
        $step['stepNo'] = 3;
        $step['description'] = "Conduct a research to locate any usable reference points near the subject lot, as well as plans of the subject lot's adjoining properties.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Ready for Survey";
        $step['stepNo'] = 4;
        $step['description'] = "The office is ready to conduct a survey, please expect or request for a suitable schedule of survey. The office will be notifying your property's adjoining lot owners about the survey.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Preparing Documents";
        $step['stepNo'] = 5;
        $step['description'] = "The office is preparing your lot's Survey Returns. Once completed, the office will expect full payment.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Done";
        $step['stepNo'] = 6;
        $step['description'] = "All documents has been submitted.";
        $step->save();

        // Topographic Survey
        $service = new Service;
        $service['name'] = "Topographic Survey"; 
        $service['description'] = "Locates all surface features of a property, and depicts all-natural features and elevations. It's essentially a 3d map of a 3d property showing all-natural and man-made features and improvements. specifically, it shows their location, size, height, and any changes in elevation.";
        $service->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Client's information";
        $step['stepNo'] = 1;
        $step['description'] = "Collect the client's Full name, Contact number, Home address and Email address.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Required document/s";
        $step['stepNo'] = 2;
        $step['description'] = "Collect any documents from the client, it could be either the land title, tax declaration, or any approved plans.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Conducting Research";
        $step['stepNo'] = 3;
        $step['description'] = "Conduct a research to locate any usable reference points near the subject lot, as well as plans of the subject lot's adjoining properties.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Ready for Survey";
        $step['stepNo'] = 4;
        $step['description'] = "The office is ready to conduct a survey, please expect or request for a suitable schedule of survey. The office will be notifying your property's adjoining lot owners about the survey.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Preparing Documents";
        $step['stepNo'] = 5;
        $step['description'] = "The office is preparing your lot's Topographic Map. Once completed, the office will expect full payment.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Done";
        $step['stepNo'] = 6;
        $step['description'] = "All documents has been submitted.";
        $step->save();

        // Topographic Survey
        $service = new Service;
        $service['name'] = "Construction Survey"; 
        $service['description'] = "Presents locations and marks for construction activities, measurements are done for reference points which determine the location of the planned structure or improvements, vertical and horizontal positioning, dimensions, configuration, and to control the elevation of the new structures.";
        $service->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Client's information";
        $step['stepNo'] = 1;
        $step['description'] = "Collect the client's Full name, Contact number, Home address and Email address.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Collecting Required document/s";
        $step['stepNo'] = 2;
        $step['description'] = "Collect any documents from the client, it could be either the land title, tax declaration, or any approved plans.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Conducting Research";
        $step['stepNo'] = 3;
        $step['description'] = "Conduct a research to locate any usable reference points near the subject lot, as well as plans of the subject lot's adjoining properties.";
        $step->save();
        
        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Construction Design";
        $step['stepNo'] = 4;
        $step['description'] = "The office will need the designs for all the pertinent structures to be built.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Ready for Survey";
        $step['stepNo'] = 5;
        $step['description'] = "The office is ready to conduct a survey, please expect or request for a suitable schedule of survey. The office will be notifying your property's adjoining lot owners about the survey.";
        $step->save();

        $step = new Step;
        $step['service_id'] = $service->id;
        $step['name'] = "Done";
        $step['stepNo'] = 6;
        $step['description'] = "All tasks has been performed.";
        $step->save();

    }
}
