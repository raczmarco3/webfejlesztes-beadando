import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ActorService } from 'src/app/service/actor-service';

@Component({
  selector: 'app-new-actor',
  templateUrl: './new-actor.component.html',
  styleUrls: ['./new-actor.component.css']
})
export class NewActorComponent {
  constructor(private actorService: ActorService) { }

  addActorForm = new FormGroup({
    name: new FormControl(),
    birthDate: new FormControl(),
    birthPlace: new FormControl()
  });

  jsonContent: JSON;
  obj: any;
  msg: any;
  processing: boolean;
  submit: boolean = false;

  onSubmit() {
    this.submit = true;
    this.obj = {
      "name": this.addActorForm.get('name')?.value,
      "birthDate": this.addActorForm.get('birthDate')?.value,
      "birthPlace": this.addActorForm.get('birthPlace')?.value
    };
    this.jsonContent = <JSON>this.obj;

    this.processing = true;
    this.actorService.addActor(this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.processing = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.processing = false;
        }
      }
    );
  }
}
