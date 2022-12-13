import { Component } from '@angular/core';
import { FormControl, FormGroup } from '@angular/forms';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { Actor } from 'src/app/model/actor';
import { ActorService } from 'src/app/service/actor-service';

@Component({
  selector: 'app-edit-actor',
  templateUrl: './edit-actor.component.html',
  styleUrls: ['./edit-actor.component.css']
})
export class EditActorComponent {
  constructor(private route: ActivatedRoute, private actorService: ActorService) { }

  editActorForm = new FormGroup({
    name: new FormControl(),
    birthDate: new FormControl(),
    birthPlace: new FormControl()
  });

  private routeSub: Subscription;
  jsonContent: JSON;
  obj: any;
  msg: any;
  isFetching: boolean;
  actor: Actor;
  id: number;

  ngOnInit() {
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    });

    this.isFetching = true;
    this.actorService.getActor(this.id).subscribe(
      {
        next: (respone) => {
          this.actor = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }

  onSubmit() {
    this.obj = {
      "id": this.id,
      "name": this.editActorForm.get('name')?.value,
      "birthDate": this.editActorForm.get('birthDate')?.value,
      "birthPlace": this.editActorForm.get('birthPlace')?.value
    };
    this.jsonContent = <JSON>this.obj;

    this.isFetching = true;
    this.actorService.editActor(this.id, this.jsonContent).subscribe(
      {
        next: (msg) => {
          this.msg = msg.msg;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }
}
