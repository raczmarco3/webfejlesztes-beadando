import { Component } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Subscription } from 'rxjs';
import { Actor } from '../model/actor';
import { Movie } from '../model/movie';
import { ListRegistryService } from '../service/list-registry-service';
import { MovieService } from '../service/movie-service';

@Component({
  selector: 'app-list-movie-registry',
  templateUrl: './list-movie-registry.component.html',
  styleUrls: ['./list-movie-registry.component.css']
})
export class ListMovieRegistryComponent {
  
  private routeSub: Subscription;
  actors: Actor[] = [];
  isFetching: boolean;
  msg: any;
  id: number;
  movie: Movie;

  constructor(private route: ActivatedRoute, private listRegistryService: ListRegistryService, private movieService: MovieService) { }

  ngOnInit() {
    this.isFetching = true;
    this.routeSub = this.route.params.subscribe(params => {
      this.id = params['id']
    });

    this.movieService.getMovie(this.id).subscribe(
      {
        next: (respone) => {
          this.movie = respone;
          this.isFetching = false;
        },    
        error: (msg) => { 
          this.msg = msg.error.msg;
          this.isFetching = false;
        }
      }
    );

    this.listRegistryService.listActors(this.id).subscribe(
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

  ngOnDestroy() {
    this.routeSub.unsubscribe();
  }

}
