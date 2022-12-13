import { Component } from '@angular/core';
import { Actor } from 'src/app/model/actor';
import { ActorService } from 'src/app/service/actor-service';

@Component({
  selector: 'app-list-actor',
  templateUrl: './list-actor.component.html',
  styleUrls: ['./list-actor.component.css']
})
export class ListActorComponent {
  actors: Actor[] = [];
  isFetching: boolean;
  msg: any;

  constructor(private actorService: ActorService) { }

  ngOnInit() {
    this.isFetching = true;
    this.actorService.getAllActor().subscribe(
      {
        next: (respone) => {
          this.actors = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );
  }
}
