import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { Actor } from '../model/actor';
import { Movie } from '../model/movie';
import { ActorService } from '../service/actor-service';
import { ListRegistryService } from '../service/list-registry-service';

@Component({
  selector: 'app-list-actor-registry',
  templateUrl: './list-actor-registry.component.html',
  styleUrls: ['./list-actor-registry.component.css']
})
export class ListActorRegistryComponent {
  private routeSub: Subscription;
  movies: Movie[] = [];
  isFetching: boolean;
  msg: any;
  id: number;
  actor: Actor;

  constructor(private route: ActivatedRoute, private listRegistryService: ListRegistryService, private actorService: ActorService) { }

  ngOnInit() {
    this.isFetching = true;
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    });

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

    this.listRegistryService.listMovies(this.id).subscribe(
      {
        next: (respone) => {
          this.movies = respone;
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
